import React, { useState } from 'react'
import { Link } from 'react-router-dom';
import api from '../api/api';
import { useNavigate } from 'react-router-dom';
import "../styles/LoginPage.css";
import TextField from '../components/TextField';

const LoginPage = () => {

  const[email, setEmail] = useState(""); //pri otvaranju stranice, email i password su prazni
  const[password, setPassword] = useState("");
 
  const navigate = useNavigate(); //kuka za navigaciju

  const [loading, setLoading] = useState(false); //Loading - kuka stanja
  const [error, setError] = useState("");
  const [info, setInfo] = useState("");


  //login logika je u ovoj funkciji, poziva se kada se forma submituje
      const handleSubmit = async(e) => {
          e.preventDefault(); //sprecava refresh stranice prilikom submitovanja forme 
          setLoading (true);
          setError("");
          setInfo("");
    
          try{
              const res = await api.post('/login', {email, password}) //await ceka odgovor od servera pa nastavlja sa narednim linijama koda
              const { token, user, message } = res.data;

              localStorage.setItem("token", token); //cuvamo token u local storage-u
              localStorage.setItem("user", JSON.stringify (user)); //user je objekat, pa ga pretvaramo u string pre cuvanja u local storage

              setInfo(message ||  "Uspešno ste prijavljeni.");
              setLoading(false);
              setTimeout(() => navigate('/restaurants'), 700); //nakon uspesne prijave, preusmeravamo korisnika na stranicu sa restoranima

          }catch(error){
              console.log(error);
              setLoading(false);
                if (error.response) {
                  if (error.response.status === 401) {
                    setError("Neispravan email ili lozinka. Pokušajte ponovo.");
                  } else if (error.response.status === 422) {
                    setError("Molimo popunite sva polja ispravno.");
                  } else if (error.response.status === 404){
                    setError("Nalog sa ovom email adresom ne postoji.");
                  }
                }else {
                  setError("Ne može se uspostaviti veza sa serverom.");
                }
}
        }

  return (
    <div className="auth-page">
      <div className = "auth-card">
        <h1 className = "auth-title">Prijava na NomNomGo</h1>
        <p className = "auth-subtitle">
          Uloguj se na svoj nalog i uživaj u brzoj i sigurnoj dostavi hrane iz omiljenih restorana.  
        </p> 

        <form className = "auth-form" onSubmit={handleSubmit}>

             <TextField
              id="email" 
              label = "Email adresa" 
              placeholder="ime.prezime@example.com"
              value={email}
              onChange={(e) => setEmail(e.target.value)} //svaki put kada korisnik unese karakter u input polje, poziva se ova funkcija
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

          {info && <div className="auth-alert-info">{info} </div>}
          {error && <div className="auth-alert-error">{error} </div>}
  
          <button type = "submit" className = "btn-primary auth-button" disabled={loading}>
            {loading ? "Prijavljivanje..." : "Prijavi se"}
          </button>

          <div className = "auth-extra">
            <p>Nemate nalog? <Link to="/register">Registrujte se</Link></p>
          </div>
        </form>
      </div>
    </div>
  )
}

export default LoginPage
