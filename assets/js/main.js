const mwd_info = 'Javascript wurde erfolgreich geladen';
console.info(mwd_info);

const menuButton = document.querySelector('.menu-button');
const menuContainer = document.querySelector('.menu-container ul');

menuButton.addEventListener('click', () => {
  menuContainer.classList.toggle('open');
});