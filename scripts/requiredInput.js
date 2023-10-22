function requiredInput() {
    let isValid = true;
  
    document.querySelectorAll(".required-input").forEach(requiredForm => {
      const input = requiredForm.querySelector('.form-control'); // Utilisez querySelector pour obtenir le premier élément correspondant
      const errorMessage = requiredForm.querySelector('.error-message');
  
      if (input.value === "") {
        isValid = false;
        input.classList.add('border-danger');
        errorMessage.classList.remove('d-none');
        errorMessage.textContent = "Champ obligatoire"; // Utilisez textContent pour définir le texte
      } else {
        input.classList.remove('border-danger');
        errorMessage.classList.add('d-none');
        errorMessage.textContent = "";
      }
    });
  
    return isValid;
  }