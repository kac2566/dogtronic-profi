import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import { resolve, join } from 'path';
import { glob } from 'glob';
import fs from 'fs';
import path from 'path';

const patternsPath = join(__dirname, 'patterns').replace(/\\/g, '/');

// --- Funkcja generująca dev entry ---
function generateDevEntry() {
  const files = [
    resolve(__dirname, 'assets/js/main.js'),
    resolve(__dirname, 'assets/scss/main.scss'),
    ...glob.sync(`${patternsPath}/*/assets/*.js`),
    ...glob.sync(`${patternsPath}/*/assets/*.scss`),
  ];

  const devEntryPath = resolve(__dirname, 'assets/js/.dev-entry.js');

  const content = files
    .map((f) => {
      let relative = path
        .relative(path.dirname(devEntryPath), f)
        .replace(/\\/g, '/');
      return `import './${relative}';`;
    })
    .join('\n');

  fs.writeFileSync(devEntryPath, content, 'utf-8');
  return devEntryPath;
}

const devEntry =
  process.env.NODE_ENV === 'development' ? generateDevEntry() : null;

// --- Funkcja tworząca pattern entries dla produkcji ---
const createPatternEntries = (extension) => {
  const pattern = `${patternsPath}/*/assets/*.${extension}`;
  return glob.sync(pattern).reduce((acc, file) => {
    const normalizedFile = file.replace(/\\/g, '/');
    const name = normalizedFile.match(/patterns\/([^/]+)\/assets\/(.+)\.\w+$/);

    if (name) {
      const suffix = extension === 'js' ? '' : '-style';
      const entryName = `patterns/${name[1]}/${name[2]}${suffix}`;
      acc[entryName] = file;
    }
    return acc;
  }, {});
};

const patternEntries = {
  ...createPatternEntries('js'),
  ...createPatternEntries('scss'),
};

// --- Konfiguracja Vite ---
export default defineConfig({
  plugins: [liveReload(['**/*.php', 'theme.json', 'patterns/**/*.php'])],
  css: {
    preprocessorOptions: {
      scss: {
        api: 'modern-compiler',
      },
    },
  },
  root: '',
  base:
    process.env.NODE_ENV === 'development'
      ? '/'
      : '/wp-content/themes/dogtronic/dist/',
  build: {
    outDir: resolve(__dirname, 'dist'),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input:
        process.env.NODE_ENV === 'development'
          ? devEntry
          : {
              main: resolve(__dirname, 'assets/js/main.js'),
              style: resolve(__dirname, 'assets/scss/main.scss'),
              ...patternEntries,
            },
      output: {
        entryFileNames: (chunkInfo) => {
          const name = chunkInfo.name.replace('-style', '');
          return `${name}.js`;
        },
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          if (
            assetInfo.name &&
            (assetInfo.name.endsWith('.css') ||
              assetInfo.name.endsWith('.scss'))
          ) {
            const name = assetInfo.name
              .replace('-style', '')
              .replace(/\.(css|scss)$/, '');
            return `${name}.css`;
          }
          return 'assets/[name][extname]';
        },
      },
    },
  },
  server: {
    host: '0.0.0.0',
    port: 5050,
    strictPort: true,
    cors: {
      origin: '*',
      credentials: true,
    },
    hmr: {
      host: 'localhost',
      protocol: 'ws',
      clientPort: 5050,
    },
    watch: {
      usePolling: true,
      interval: 100,
    },
    origin: 'http://localhost:5050',
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, 'assets'),
    },
  },
});
