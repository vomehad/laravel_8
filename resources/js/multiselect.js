const multiselect_block = document.querySelectorAll(".multiselect_block");

multiselect_block.forEach(parent => {
    const label = parent.querySelector(".field_multiselect");
    const select = parent.querySelector(".field_select");
    const text = label.innerHTML;

    select.addEventListener("change", function(elem) {
        const selectedOptions = this.selectedOptions;

        label.innerHTML = "";

        for (const option of selectedOptions) {
            const button = document.createElement("button");

            button.type = "button";
            button.className = "btn_multiselect";
            button.textContent = option.value;
            button.onclick = _ => {
                option.selected = false;
                button.remove();

                if (!select.selecetedOptions.length) {
                    label.innerHTML = text;
                }
            }
            label.append(button);
        }
    });
});
