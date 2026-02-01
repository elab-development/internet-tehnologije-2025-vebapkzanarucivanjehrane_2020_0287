import React, { useState } from 'react'
import { FaEye, FaEyeSlash} from 'react-icons/fa';

const TextField = ({
    id, 
    label, 
    type = "text", 
    value, onChange, 
    placeholder, 
    required = false, 
    hint,
    showPasswordToggle = false, 
    ...rest
}) => {

    //postavljamo da sifra moze biti sakrivena/otkrivena
    const[showPassword, setShowPassword] = useState(false);
    const isPassword = type === "password";

    const inputType = isPassword && showPasswordToggle ? (showPassword ? "text" : "password") : type; //da li je polje text/password


  return (
    <div className= "auth-field">
        {label && <label htmlFor={id}>{label}</label>}
        <div className= "auth-input-wrapper">
            <input 
                id={id}
                type={inputType}
                className = "" 
                value={value}
                onChange={onChange}
                placeholder={placeholder}
                required={required}
                {...rest}
          />


        {isPassword && showPasswordToggle && ( //na polja koja su tipa password dodajemo dugme prikazi/sakrij 
            <button type = "button"
                    className= "toggle-password-btn"
                    onClick={() => setShowPassword((prev) => !prev)} //na klik uzima prethodnu vrednost i postavlja suprotnu
            >
                {showPassword ? <FaEyeSlash /> : <FaEye />}
            </button>
        )}
        </div>

        {hint && <small className="auth-hint">{hint}</small>}

    </div>
  )
}

export default TextField
