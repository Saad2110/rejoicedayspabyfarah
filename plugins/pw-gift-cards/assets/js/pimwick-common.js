//
// Validate an email address.
// Source: https://stackoverflow.com/questions/46155/742A456.B055BB/how-to-validate-an-email-address-in-javascript
//
function pimwickValidateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
