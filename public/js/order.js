/* Modal and Shopping Cart functionalities */
const modal = document.querySelector(".modal");
const modalTriggers = document.querySelectorAll(".card-light");
const closeBtn = document.querySelector(".close");
const heading = document.querySelector(".modal-heading");
const desc = document.querySelector(".modal-desc");
const price = document.querySelector(".modal-price");
const plus = document.querySelector(".fa-plus-circle");
const minus = document.querySelector(".fa-minus-circle");
const quantity = document.querySelector(".quantity");
const addCart = document.querySelector(".add-cart");
const cartQty = document.querySelector(".cart-qty");

for (let modalTrigger of modalTriggers) {
    modalTrigger.onclick = () => {
        modal.style.display = "block";
        heading.innerHTML = modalTrigger.childNodes[1].innerHTML;
        desc.innerHTML = modalTrigger.childNodes[3].innerHTML;
        price.innerHTML = modalTrigger.childNodes[5].innerHTML;
        quantity.innerHTML = 1;
        addCart.innerHTML = "Add to Cart";
        
        changeQty();
        
        closeBtn.onclick = () => {
            modal.style.display = "none";
        }
        
        addCart.onclick = () => {
            addCart.innerHTML = "Adding to Cart...";    
            setTimeout(() => { 
                cartQty.innerHTML = parseInt(cartQty.innerHTML) + parseInt(quantity.innerHTML);
                modal.style.display = "none"; 
            }, 750);
        }
    }    
}
  
window.onclick = (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

function changeQty() {
    const priceUnformatted = price.innerHTML.substring(1);
    
    plus.onclick = () => {
        quantity.innerHTML = parseInt(quantity.innerHTML) + 1;
        price.innerHTML = `$${(Math.round((priceUnformatted * parseInt(quantity.innerHTML) + Number.EPSILON) * 100) / 100).toFixed(2)}`;
    }
    minus.onclick = () => {
        if (parseInt(quantity.innerHTML) > 1) {
            quantity.innerHTML = parseInt(quantity.innerHTML) - 1;
            price.innerHTML = `$${(Math.round((priceUnformatted * parseInt(quantity.innerHTML) + Number.EPSILON) * 100) / 100).toFixed(2)}`;
        }
    }
}