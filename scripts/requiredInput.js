function requiredInput(requiredInput = ".required-input") {

    let isValid = true;

    document.querySelectorAll(requiredInput).forEach(requiredForm => {
      const input = requiredForm.querySelector('.form-control');
      const errorMessage = requiredForm.querySelector('.error-message');

      if (input.value === "") {
        isValid = false;
        input.classList.add('border-danger');
        errorMessage.classList.remove('d-none');
        errorMessage.textContent = "Champ obligatoire";
      } else {
        input.classList.remove('border-danger');
        errorMessage.classList.add('d-none');
        errorMessage.textContent = "";
      }

    });

    return isValid;
    
  }