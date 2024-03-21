window.onload = function()
{
    let checkbox = document.getElementById("checkbox");
    let tagClass = document.getElementById("tagClass");

    if (checkbox.checked) {
        tagClass.removeAttribute("disabled");

    } else {
        tagClass.setAttribute("disabled", "");
    };

    checkbox.addEventListener('change', function()
    {
    if (this.checked) {
        tagClass.removeAttribute("disabled");
    } else {
        tagClass.setAttribute("disabled", "");
    }
    });
};
