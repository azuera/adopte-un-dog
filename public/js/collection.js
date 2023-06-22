const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector(
        "." + e.currentTarget.dataset.collectionHolderClass
    );

    const item = document.createElement("li");

    item.innerHTML = collectionHolder.dataset.prototype.replace(
        /__name__/g,
        collectionHolder.dataset.index
    );

    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;

    addChildFormDeleteLink(item);

    item.querySelectorAll('.tom-select').forEach((el)=>{
        let settings = {
            plugins: ['remove_button']
        };
        new TomSelect(el,settings);
    });

    initEvents();
};

const addChildFormDeleteLink = (item) => {
    const removeFormButton = document.createElement("button");
    removeFormButton.innerText = "Supprimer";
    removeFormButton.classList.add("btn");
    removeFormButton.classList.add("btn-danger");

    item.prepend(removeFormButton);

    removeFormButton.addEventListener("click", (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
};

const initEvents = function() {
    document.querySelectorAll("[data-collection-element]").forEach((element) => {
        addChildFormDeleteLink(element);
    });
    document.querySelectorAll(".add_item_link").forEach((btn) => {
        btn.removeEventListener("click", addFormToCollection);
        btn.addEventListener("click", addFormToCollection);
    });
};

initEvents();
