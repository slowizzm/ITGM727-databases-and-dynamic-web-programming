//event listeners
const cardDropDowns = document.querySelectorAll('.card-more');

//styles to update
const cards = document.querySelectorAll('.card');
const dropContents = document.querySelectorAll('.admin-dropdown-content');

//add event listener to all buttons on card
for (let i = 0; i < cards.length; i++) {
    cardDropDowns[i].addEventListener('click', _ => {
        dropContents[i].classList.toggle('show');
    });
}