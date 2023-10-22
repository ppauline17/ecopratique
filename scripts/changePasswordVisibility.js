function changePasswordVisibility(eye, eyeSlash, inputElement){
    const eyeIcon = document.getElementById(eye);
    const eyeSlashIcon = document.getElementById(eyeSlash);
    const input = document.getElementById(inputElement);
    if(input.type=="text"){
        input.type="password";
        eyeIcon.classList.remove('d-none');
        eyeSlashIcon.classList.add('d-none');
    }else{
        input.type="text";
        eyeIcon.classList.add('d-none');
        eyeSlashIcon.classList.remove('d-none');
    }
    return input.type;
}