function requiredInput() {
    let isValid = true;

    document.querySelectorAll(".required-input").forEach(input => {
        const errorMessage = input.nextElementSibling;

        if (input.value === "") {
            isValid = false;
            input.classList.add('border-danger');
            errorMessage.classList.remove('d-none');
        }else{
            input.classList.remove('border-danger');
            errorMessage.classList.add('d-none');
        }
    });
    return isValid;
}