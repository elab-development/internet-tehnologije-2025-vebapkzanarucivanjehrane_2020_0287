import React, { useState } from 'react'
import { Link } from 'react-router-dom';
import api from '../api/api';
import { useNavigate } from 'react-router-dom';
import "../styles/LoginPage.css";
import TextField from '../components/TextField';
import { FaPizzaSlice, FaBolt, FaCreditCard } from 'react-icons/fa';

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
        const { access_token, user, message } = res.data;

        localStorage.setItem("token", access_token.split('|')[1]); //deli token na 2 dela, prvi je id, drugi je token (mi cuvamo token)
        localStorage.setItem("user", JSON.stringify (user)); //user je objekat, pa ga pretvaramo u string pre cuvanja u local storage

        setInfo(message ||  "Uspešno ste prijavljeni.");
        setLoading(false);
        const role = user.role;
            if (role === 'admin') setTimeout(() => navigate('/admin'), 700);
            else if (role === 'dostavljac') setTimeout(() => navigate('/dostave'), 700);
            else setTimeout(() => navigate('/restaurants'), 700); //nakon uspesne prijave, preusmeravamo korisnika na stranicu sa restoranima

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
    <div className="auth-box">

      <div className="auth-left">
        <div className="auth-logo">NomNom<span>GO</span></div>
        <h2>Dobrodošli nazad!</h2>
        <p>Prijavite se i naručite iz omiljenih restorana za nekoliko klikova.</p>
        <div className="auth-perks">
          <div className="perk"><div className="perk-dot"><FaPizzaSlice></FaPizzaSlice></div><span>100+ restorana u ponudi</span></div>
          <div className="perk"><div className="perk-dot"><FaBolt></FaBolt></div><span>Dostava za ~30 minuta</span></div>
          <div className="perk"><div className="perk-dot"><FaCreditCard></FaCreditCard></div><span>Sigurno plaćanje</span></div>
        </div>
      </div>

      <div className="auth-right">
        <div className="auth-card">
          <h1 className="auth-title">Prijava</h1>
          <p className="auth-subtitle">Unesite vaše podatke za pristup nalogu.</p>
          <form className="auth-form" onSubmit={handleSubmit}>
            <TextField
              id="email"
              label="Email adresa"
              placeholder="ime.prezime@example.com"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
            <TextField
              id="password"
              label="Lozinka"
              type="password"
              placeholder="Unesite lozinku (min 8 karaktera)"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              showPasswordToggle={true}
              required
            />
            {info && <div className="auth-alert-info">{info}</div>}
            {error && <div className="auth-alert-error">{error}</div>}
            <button type="submit" className="auth-button" disabled={loading}>
              {loading ? "Prijavljivanje..." : "Prijavi se"}
            </button>
            <div className="auth-extra">
              <p>Nemate nalog? <Link to="/register">Registrujte se</Link></p>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  )
}

export default LoginPage
