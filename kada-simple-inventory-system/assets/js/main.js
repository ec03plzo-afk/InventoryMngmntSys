(function() {
  "use strict";
  
let SideBar = document.querySelector(".SideBar");
let SideBarBtn = document.querySelector(".bx-menu-alt-right");
if(SideBarBtn){
  SideBarBtn.onclick = () => {
    SideBar.classList.toggle("sideBar-active");
  };
};
const date = document.querySelector('.date');
setInterval(() => {
  let dateTime = new Date();
  date.innerHTML = dateTime.toLocaleString();
},0);

const profileDown = document.querySelector('.Profile');
const toggleProfile = document.querySelector('.profile-menu');
profileDown.addEventListener("click", () => {
  toggleProfile.classList.toggle('active-profile');
});
})();

const popupContainer = document.querySelector('.popup-customer');
const btnAddCustomer = document.querySelector('#addCustomer');
const btnCloseCustomer = document.querySelector('.close-form');
btnAddCustomer.onclick = () => {
  popupContainer.classList.add('active-modal');
}
btnCloseCustomer.onclick = () => {
  popupContainer.classList.remove('active-modal');
}