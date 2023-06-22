const addFormToCollection = (e) => {
  const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

  const item = document.createElement('li');

  item.innerHTML = collectionHolder
    .dataset
    .prototype
    .replace(
      /__name__/g,
      collectionHolder.dataset.index
    );

  collectionHolder.appendChild(item);

  collectionHolder.dataset.index++;
  triggerEvents();
};

const triggerEvents = function() {
  document
    .querySelectorAll('.add_item_link')
    .forEach(btn => {
        btn.removeEventListener('click', addFormToCollection);
        btn.addEventListener("click", addFormToCollection)
    });
};

triggerEvents();