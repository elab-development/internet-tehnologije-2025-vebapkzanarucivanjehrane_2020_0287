import { useState } from "react";
import api from "../api/api";
import '../styles/CourierModal.css'

const CourierModal = ({ onClose }) => {
  const [form, setForm] = useState({
    ime: "",
    kontakt: "",
    grad: "",
    vozilo: "",
    napomena: ""
  });

  const[error, setError] = useState(null);
  const [success, setSuccess] = useState(null);

  const handleChange = (e) => {
    setForm({...form,[e.target.name]: e.target.value});
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      await api.post("/dostavljaci", form);
        setSuccess("Zahtev je uspešno poslat. Administrator će ga pregledati.");
        setError(null);
    } catch (error) {
        console.log(error.response?.data);
        if (error.response?.status === 400) {
            setError("Zahtev je već poslat i čeka odobrenje administratora.");
        } else if (error.response?.status === 401) {
            setError("Morate biti ulogovani.");
        } else {
            setError("Došlo je do greške. Pokušajte ponovo.");
        }
    }
};

  return (
    <div className="modal-backdrop" onClick={onClose}>
      <div className="modal" onClick={(e) => e.stopPropagation()}>
        <h2>Prijava za dostavljača</h2>

        <form onSubmit={handleSubmit}>
          <input
            name="ime"
            label="Ime i prezime"
            placeholder="Ime i prezime"
            onChange={handleChange}
            required
          />

          <input
            name="kontakt"
            label="Kontakt"
            placeholder="Kontakt telefon"
            onChange={handleChange}
            required
          />

          <input
            name="grad"
            placeholder="Grad u kom želim da radim..."
            onChange={handleChange}
            required
          />

          <select name="vozilo" onChange={handleChange} required>
            <option value="">Tip prevoza</option>
            <option value="bicikl">Bicikl</option>
            <option value="motor">Motor</option>
            <option value="auto">Automobil</option>
          </select>

          <textarea
            name="napomena"
            label="Napomena"
            placeholder="Napomena (opciono)"
            onChange={handleChange}
          />

          <button type="submit">
            Pošalji zahtev
          </button>
        </form>

        {error && (
            <div className="error-popup">
                <p>{error}</p>
            </div>
        )}
        
        {success && (
            <div className="success-popup">
                <p>{success}</p>
                    <button onClick={onClose}>
                        U redu
                    </button>
            </div>
)}

      </div>
    </div>
  );
};

export default CourierModal;
