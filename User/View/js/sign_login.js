/*=============== SHOW HIDDEN - PASSWORD ===============*/
const signUp = document.getElementById('sign-up'),
    signIn = document.getElementById('sign-in'),
    loginIn = document.getElementById('login-in'),
    loginUp = document.getElementById('login-up')


signUp.addEventListener('click', () => {
    // Remove classes first if they exist
    loginIn.classList.remove('block')
    loginUp.classList.remove('none')

    // Add classes
    loginIn.classList.toggle('none')
    loginUp.classList.toggle('block')
})

signIn.addEventListener('click', () => {
    // Remove classes first if they exist
    loginIn.classList.remove('none')
    loginUp.classList.remove('block')

    // Add classes
    loginIn.classList.toggle('block')
    loginUp.classList.toggle('none')
})



const showHiddenPass = (inputPass, inputIcon) => {
    const input = document.getElementById(inputPass),
        iconEye = document.getElementById(inputIcon)

    iconEye.addEventListener('click', () => {
        // Change password to text
        if (input.type === 'password') {
            // Switch to text
            input.type = 'text'

            // Add icon
            iconEye.classList.add('ri-eye-line')
                // Remove icon
            iconEye.classList.remove('ri-eye-off-line')
        } else {
            // Change to password
            input.type = 'password'

            // Remove icon
            iconEye.classList.remove('ri-eye-line')
                // Add icon
            iconEye.classList.add('ri-eye-off-line')
        }
    })
}

showHiddenPass('input-pass', 'input-icon')