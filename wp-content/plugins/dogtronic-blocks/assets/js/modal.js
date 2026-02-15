/**
 * Global Video Popup Logic
 */
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('dogtronic-video-popup-modal');

  // If modal doesn't exist, we can't do anything
  if (!modal) return;

  const video = modal.querySelector('video');
  const closeBtn = modal.querySelector('.dogtronic-video-popup-close');
  const triggers = document.querySelectorAll('.dogtronic-video-popup-trigger');

  if (!video || !triggers.length) return;

  // Open Modal
  triggers.forEach((trigger) => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const videoUrl = trigger.getAttribute('data-video-url');

      if (videoUrl) {
        video.src = videoUrl;
        modal.classList.add('is-active');
        video.play();
        document.body.style.overflow = 'hidden'; // Prevent scrolling
      }
    });
  });

  // Close Function
  const closeModal = () => {
    modal.classList.remove('is-active');
    video.pause();
    video.currentTime = 0;
    video.src = ''; // Clear source to stop buffering
    document.body.style.overflow = '';
  };

  // Close on button click
  if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
  }

  // Close on background click
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });

  // Close on ESC key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('is-active')) {
      closeModal();
    }
  });
});
