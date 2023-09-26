document.addEventListener('DOMContentLoaded', function() {

  function setElementDisplay(element, display) {
    if (!element) {
      console.error("Element not found.");
      return;
    }
    element.style.display = display;
  }

function toggleModalControls() {
  const windowWidth = window.innerWidth;

  document.querySelectorAll('.dump-block').forEach(function(container) {
    const ctrlOuter = container.querySelector('.dump-block__ctrl-outer');

    if (windowWidth <= 768) {
      setElementDisplay(ctrlOuter, 'none');
      container.classList.remove('dump-block__modal');
      return;
    }

    setElementDisplay(ctrlOuter, 'flex');
    if (container.classList.contains('dump-block__modal--center')) {
      container.classList.add('dump-block__modal');
    }
  });
}


  function setButtonHandlers(innerWrapper, container, closeModalBtn) {
  innerWrapper.querySelectorAll('.dump-block__control-button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const windowWidth = window.innerWidth;
      if (windowWidth <= 768) return; // disable below 768px

        setElementDisplay(closeModalBtn, 'block');

        const styleKey = btn.getAttribute('data-position');
        if (!container) {
          console.error("Container not found.");
          return;
        }
        container.className = 'dump-block ' + styleKey;
        container.classList.add('dump-block__modal');
      });
    });
  }

  function closeModalHandler(container, closeModalBtn) {
    closeModalBtn.addEventListener('click', function() {
      const windowWidth = window.innerWidth;
      if (windowWidth <= 768) return; // disable below 768px
      setElementDisplay(closeModalBtn, 'none');

      if (!container) {
        console.error("Container not found.");
        return;
      }
      container.className = 'dump-block';
      container.classList.remove('dump-block__modal');
    });
  }

  toggleModalControls();
  window.addEventListener('resize', toggleModalControls);

  document.querySelectorAll('.dump-block').forEach(function(container) {
    const innerWrapper = container ? container.querySelector('.dump-block__ctrl-wrapper') : null;
    const closeModalBtn = container ? container.querySelector('.dump-block__control-button--close') : null;

    if (!innerWrapper || !closeModalBtn) {
      console.error("Element(s) not found.");
      return;
    }

    setElementDisplay(closeModalBtn, 'none');
    setButtonHandlers(innerWrapper, container, closeModalBtn);
    closeModalHandler(container, closeModalBtn);
  });
});