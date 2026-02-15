import './style.scss';

document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.dogtronic-block-tabs');

  tabs.forEach((tabBlock) => {
    const triggers = tabBlock.querySelectorAll('.dogtronic-tab-title');
    const panels = tabBlock.querySelectorAll('.dogtronic-tab-panel');

    if (triggers.length === 0 || panels.length === 0) return;

    if (!tabBlock.querySelector('.is-active')) {
      triggers[0].classList.add('is-active');
      panels[0].hidden = false;
    }

    triggers.forEach((trigger, index) => {
      trigger.addEventListener('click', () => {
        triggers.forEach((t) => {
          t.classList.remove('is-active');
          t.setAttribute('aria-selected', 'false');
        });
        panels.forEach((p) => (p.hidden = true));

        trigger.classList.add('is-active');
        trigger.setAttribute('aria-selected', 'true');

        if (panels[index]) {
          panels[index].hidden = false;
        }
      });
    });
  });
});
