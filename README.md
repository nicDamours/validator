# Validator
This is a simple validator library to validate some input.

### Installation 
You can install it using composer : 
~~~~
composer require nicdamours/validator
~~~~

### Usage
To use the library, simply call the static method `make` of the Validator object, then select your input to validate, and use the `validate` function at the end.
<br> Ex:
<br>
```php
    $myObject = [
        'name' => 'John Doe',
        'age' => 26,
        'isAdult' => true,
        'email' => 'j.doe@example.com',
        'birthdate' => '1990-01-01'
    ];
    
    return Validator::make($myObject)
                        ->name('name')
                        ->int('age')
                        ->boolean('isAdult')
                        ->email('email')
                        ->date('birthDate')
                        ->validate();
```

Be default, all parameters are optionals, unless you tell the validation function not to. <br>
Ex : 
```php
    $myObject = [
        'name' => 'John Doe',
        'age' => null,
        'isAdult' => true,
        'email' => 'j.doe@example.com',
        'birthdate' => '1990-01-01'
    ];
    
    return Validator::make($myObject)
                        ->name('name', false // this cannot be null.)
                        ->int('age')
                        ->boolean('isAdult',  false // this cannot be null.)
                        ->email('email',  false // this cannot be null.)
                        ->date('birthDate',  false // this cannot be null.)
                        ->validate();

```

Currently, we support those validation method.


- email
- password ( 7 to 20 letter, number, special char, must have one uppercase )
- title
- datetime ( `YYYY-MM-DD hh:mm:ss` )
- date ( `YYYY-MM-DD` )
- isoDatetime ( `YYYY-MM-DDThh:mm:ss+0500` the timezone can be format `0500` or `05:00`, or any other number)
- boolean ( as boolean or string )
- id ( int )
- int 
- arrayOfString
- arrayOfInt
- path ( `/var/www/html` )
- version ( Ex: 1, 1.2, 1.2.3);
- HEX color ( `#ffffff`, `#fff`)