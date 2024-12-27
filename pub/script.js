'use strict';

const itemPrices = {
    hamburger: 5.99,
    potato: 2.49,
    drinks: 1.99,
    meat: 10.99
};

const itemImages = {
    hamburger: './hamburger.jpg',
    potato: './potato.jpg',
    drinks: './drinks.jpg',
    meat: './meat.jpg'
};

const itemsContainer = document.getElementById('items-container');
const totalItemsEl = document.getElementById('total-items');
const totalPriceEl = document.getElementById('total-price');
const itemCategoryEl = document.getElementById('item-category');
const itemPriceEl = document.getElementById('item-price');

itemCategoryEl.addEventListener('change', () => {
    const selectedItem = itemCategoryEl.value;
    itemPriceEl.value = `$${itemPrices[selectedItem].toFixed(2)}`;
});

window.addEventListener('load', () => {
    itemCategoryEl.dispatchEvent(new Event('change'));
});

document.getElementById('add-item').addEventListener('click', () => {
    const name = itemCategoryEl.options[itemCategoryEl.selectedIndex].text;
    const price = itemPrices[itemCategoryEl.value];
    const imageSrc = `./images/${itemImages[itemCategoryEl.value]}`;

    const itemBlock = document.createElement('div');
    itemBlock.classList.add('bg-amber-300', 'p-4', 'rounded-lg', 'flex', 'justify-between', 'items-center');
    itemBlock.innerHTML = `
      <div class="flex items-center space-x-4">
        <img src="${imageSrc}" alt="${name}" class="w-16 h-16 rounded-md">
        <p><strong>${name}</strong> - $${price.toFixed(2)}</p>
      </div>
      <button class="delete-btn bg-red-500 text-white p-2 rounded-lg">Delete</button>
    `;
    itemsContainer.appendChild(itemBlock);

    totalItemsEl.textContent = parseInt(totalItemsEl.textContent) + 1;
    totalPriceEl.textContent = (parseFloat(totalPriceEl.textContent) + price).toFixed(2);

    itemBlock.querySelector('.delete-btn').addEventListener('click', () => {
      itemsContainer.removeChild(itemBlock);
      totalItemsEl.textContent = parseInt(totalItemsEl.textContent) - 1;
      totalPriceEl.textContent = (parseFloat(totalPriceEl.textContent) - price).toFixed(2);
    });
});