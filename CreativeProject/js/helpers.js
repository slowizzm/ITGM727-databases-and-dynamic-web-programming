//event listeners - more, deactivate, reactivate buttons to update styles on hover/click
const cardDropDowns = document.querySelectorAll('.card-more');
const activeStatus = document.querySelectorAll('.user-active');
const inactiveStatus = document.querySelectorAll('.user-inactive');

//styles to update
const cards = document.querySelectorAll('.card');
const cardActive = document.querySelectorAll('.card-active');
const infoOpaque = document.querySelectorAll('.student-info-opaque');
const nameOpaque = document.querySelectorAll('.student-name-opaque');
const codeOpaque = document.querySelectorAll('.student-code-opaque');
const btnOpaque = document.querySelectorAll('.btn-opaque');
const dropContents = document.querySelectorAll('.admin-dropdown-content');

//add event listener to all buttons on card
for (let i = 0; i < cards.length; i++) {
    cardDropDowns[i].addEventListener('click', _ => {
        dropContents[i].classList.toggle('show');
    });

    //toggle style on deactivate click
    activeStatus[i].addEventListener('click', _ => {
        cardActive[i].classList.toggle('card-inactive');
        inactiveStatus[i].classList.toggle('show');
        activeStatus[i].classList.toggle('hidden');
        infoOpaque[i].classList.remove('opaque');
        infoOpaque[i].classList.add('no-opaque');
        nameOpaque[i].classList.remove('opaque');
        nameOpaque[i].classList.add('no-opaque');
        codeOpaque[i].classList.remove('opaque');
        codeOpaque[i].classList.add('no-opaque');
        btnOpaque[i].classList.remove('opaque');
        btnOpaque[i].classList.add('no-opaque');
    });

    //toggles styles on reactive click
    inactiveStatus[i].addEventListener('click', _ => {
        cardActive[i].classList.toggle('card-inactive');
        inactiveStatus[i].classList.toggle('show');
        activeStatus[i].classList.toggle('hidden');
        infoOpaque[i].classList.remove('no-opaque');
        infoOpaque[i].classList.add('opaque');
        nameOpaque[i].classList.remove('no-opaque');
        nameOpaque[i].classList.add('opaque');
        codeOpaque[i].classList.remove('no-opaque');
        codeOpaque[i].classList.add('opaque');
        btnOpaque[i].classList.remove('no-opaque');
        btnOpaque[i].classList.add('opaque');
    });
}