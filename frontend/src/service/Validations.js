export default class Validations {
    static checkusername(username){
        if ( username.length <= 4)
        {
            return false;
        }
        return true;
    }

    static minLength(name, minLength) {
        if (name.length < minLength) {
            return false;
        }
        return true;
    }

    static isNull(name) {
        if(name == '' || name == 0 )
        {
            return false;
        } 
        
        return true;
    }
}