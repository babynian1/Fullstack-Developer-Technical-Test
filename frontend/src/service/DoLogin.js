import Validations from "./Validations";

export default class DoLogin {
    constructor(username, password){
        this.username = username;
        this.password = password;
    }

    checkValidations() {
        let errors = [];

        if(!Validations.checkusername(this.username))
        {
            errors['username'] = 'username Tidak Valid';   
        }

        if(!Validations.minLength(this.password, 7))
        {
            errors['password'] = 'Password Minimal 8 Karakter';
        }

        return errors;

    }
}