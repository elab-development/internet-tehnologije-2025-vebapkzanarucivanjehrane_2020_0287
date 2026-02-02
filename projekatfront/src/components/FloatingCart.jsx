import { useState } from "react";
import api from "../api/api";
import "../styles/FloatingCart.css";
import { IoClose, IoTrashOutline } from "react-icons/io5";

const FloatingCart = ({ korpa, setKorpa }) => {
    const [isModalOpen, setIsModalOpen] = useState(false);

  function handleRemove(index) {
    setKorpa(prev =>
      prev.filter((_, i) => i !== index)
    );
  }
  
  function handlePoruciClick() {
    setIsModalOpen(true);
  }

  function handleConfirmOrder() {
    const adresa = document.getElementById('adresaInput').value

    api.post('/porudzbine', {
        adresa_isporuke: adresa,
        proizvodi: korpa
    }).then((res) => {
        console.log('uspesna porudzbina')
        console.log(res.data)
        setIsModalOpen(false)
        alert('Uspesno kreirana porudzbina')
    }).catch((error) => {
        console.log(error)
    })
  }

 
  const ukupno = korpa.reduce((sum, jelo) => sum + Number(jelo.cena), 0);

  return (
    <>
    <div className="floating-cart">
      <h4>Korpa</h4>

      {korpa.length === 0 ? (
        <p className="empty-cart">Korpa je prazna</p>
      ) : (
        <>
          <ul>
            {korpa.map((jelo, index) => (
              <li key={index}>
                <span>{jelo.naziv}</span>
                <span>{jelo.cena} RSD</span>
                <button onClick={() => handleRemove(index)}>
                  <IoTrashOutline />
                </button>
              </li>
            ))}
          </ul>

          <div className="cart-total">
            <strong>Ukupno:</strong> {ukupno} RSD
          </div>
        </>
      )}
      <button id="poruciButton" onClick={handlePoruciClick}>PORUCI</button>
    </div>

    {isModalOpen && (
        <div className="modal-overlay" onClick={() => setIsModalOpen(false)}>
          <div
            className="order-modal"
            onClick={(e) => e.stopPropagation()}
          >
            <button
              className="close-btn"
              onClick={() => setIsModalOpen(false)}
            >
              <IoClose />
            </button>

            <h3>Potvrda porudžbine</h3>

            <label>Adresa isporuke</label>
            <input
              id="adresaInput"
              type="text"
              placeholder="Unesite adresu..."
            />

            <div className="modal-total">
              Ukupno: <strong>{ukupno} RSD</strong>
            </div>

            <button
              className="confirm-btn"
              onClick={handleConfirmOrder}
            >
                Potvrdi porudžbinu
            </button>
          </div>
        </div>
      )}
      </>
  );
};

export default FloatingCart;
