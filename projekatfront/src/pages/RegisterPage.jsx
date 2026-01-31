import React, { useState } from 'react'
import { Link } from 'react-router-dom';
import api from '../api/api';
import { useNavigate } from 'react-router-dom';
import "../styles/LoginPage.css";
import TextField from '../components/TextField';

const RegisterPage = () => {

    const navigate = useNavigate();

    const [ime, setIme] = useState("");
    const [prezime, setPrezime] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [slika, setSlika] = useState(null);

    const[loading, setLoading] = useState(false);
    const[error, setError] = useState("");
    const[info, setInfo] = useState("");

    const handleFileChange = (e) => {    //funkcija koja radi sa fajlovima
        const file = e.target.files?.[0];
        setSlika(file || null);
      };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading (true);
        setError("");
        setInfo("");

        try{
            const formData = new FormData(); //kada radimo sa fajlovima, moramo da koristimo FormData objekat
            formData.append("ime", ime);
            formData.append("prezime", prezime);
            formData.append("email", email);
            formData.append("password", password);
            formData.append("confirmPassword", confirmPassword);
                      
            if (slika) {
              formData.append("slika", slika);
             }

            const res = await api.post('/register', formData, { //ovim hederom omogucavamo slanje fajlova
              headers: {
               'Content-Type': 'multipart/form-data',
                  },
               });

               const { message } = res.data;

            setInfo (message || "Registracija uspešna. Možete se prijaviti.");
            setLoading(false);
            setTimeout(() => navigate('/login'), 700); //posle 700ms preusmeravamo na login stranicu

        }catch(error){
            console.error(error);
            setLoading(false);

            if(error.response){
              if(error.response.status === 422){
                  setError("Validacija nije uspešna. Proverite unete podatke.");
               }else{
                  setError("Došlo je do greške prilikom registracije.");
                  }
            }
          }
          }

  return (
    <div className="auth-page">
      <div className = "auth-card">
        <h1 className = "auth-title">Registracija na NomNomGo</h1>
        <p className = "auth-subtitle">
          Kreirajte nalog i uživajte u brzoj i sigurnoj dostavi hrane iz omiljenih restorana.  
        </p>

        <form className = "auth-form" on onSubmit={handleSubmit}>
          <TextField
              id="ime"
              label = "Ime"
              value={ime}
              placeholder="Unesite ime"
              onChange={(e) => setIme(e.target.value)}
              required
            />

          <TextField
              id="prezime"
              label = "Prezime"
              placeholder="Unesite prezime"
              value={prezime}
              onChange={(e) => setPrezime(e.target.value)}
              required
            />

          <TextField
              id="email" 
              label = "Email" 
              placeholder="ime.prezime@example.com"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />

          <TextField
              id="password"
              label = "Lozinka"
              type = "password"
              placeholder="Unesite lozinku (min 8 karaktera)"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              showPasswordToggle = {true}
              required
            />

          <TextField
              id="confirmPassword"
              label = "Potvrda lozinke"
              type="password"
              placeholder="Ponovo unesite lozinku"
              value={confirmPassword}
              onChange={(e) => setConfirmPassword(e.target.value)}
              showPasswordToggle = {true}
              required
            />

          <div className="auth-field">
            <label htmlFor="slika">Profilna slika (opciono)</label>
            <input
              id="slika"
              type="file"
              accept="image/png, image/jpeg, image/jpg"
              onChange={handleFileChange} //funkcija koja radi sa fajlovima
            />
              <small className = "auth-hint">Dozvoljeni formati: PNG, JPEG, JPG. Maksimalna veličina slike 2MB</small>
          </div>

          {info && <div className="auth-alert-info">{info} </div>}
          {error && <div className="auth-alert-error">{error} </div>}

          <button type = "submit" className = "btn-primary auth-button" disabled={loading}>
            {loading ? "Registracija u toku..." : "Registruj se"}
          </button>

        </form>
      </div>
    </div>
  );
  
}

export default RegisterPage;
