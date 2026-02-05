import { useState } from "react";
import api from "../api/api";
import "../styles/FloatingCart.css";
import { IoClose, IoTrashOutline,IoCartOutline} from "react-icons/io5";

const FloatingCart = ({ korpa, setKorpa }) => {

  const [isModalOpen, setIsModalOpen] = useState(false);
  const [orderSuccess, setOrderSuccess] = useState(false);
  const [orderError, setOrderError] = useState(false);
  const [isCartOpen, setIsCartOpen] = useState(true);
  
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
        setOrderSuccess(true);
        setOrderError(false);      
        setKorpa([]);               
    }).catch((error) => {
        console.log(error)
        setOrderError(true);
        setOrderSuccess(false);
    })
  }
 
  const ukupno = korpa.reduce((sum, jelo) => sum + Number(jelo.cena), 0);

    if (!isCartOpen) {
      return (
        <button className="floating-cart-button"
          onClick={() => setIsCartOpen(true)}>
        <IoCartOutline /> Korpa
      </button>
    );
  }

  return (
    <>
    <div className="floating-cart">
        <h4 className="cart-title">
          <IoCartOutline className="cart-icon" />
          Korpa
        </h4>

        <button className="cart-close"
          onClick={() => setIsCartOpen(false)}>
            <IoClose />
        </button>

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
      <button id="poruciButton" onClick={handlePoruciClick}>
        PORUČI
      </button>
    </div>

    {isModalOpen && (
        <div className="modal-overlay" onClick={() => {
            setIsModalOpen(false);
            setOrderSuccess(false);
          }}
        >
         <div className="order-modal" onClick={(e) => e.stopPropagation()}>
            <button className="close-btn" onClick={() => {
                setIsModalOpen(false);
                setOrderSuccess(false);
              }}>
                <IoClose />
            </button>

       {orderSuccess ? (
           <>
          <h3>Uspešno kreirana porudžbina</h3>
            <p className="success-text">
                Hvala vam! Vaša porudžbina je uspešno poslata.
            </p>

              <button className="confirm-btn" onClick={() => {
                  setIsModalOpen(false);
                  setOrderSuccess(false);
                  setOrderError(false);
                  }}>
                      Zatvori
                </button>
              </>
            ) : orderError ? (
              <>
          <h3> Greška</h3>
            <p className="error-text">
              Došlo je do greške prilikom kreiranja porudžbine.
            </p>

              <button className="confirm-btn"
                onClick={() => setOrderError(false)}>
                  Pokušaj ponovo
              </button>
            </>
          ) : (
            <>

           <h3>Potvrda porudžbine</h3>
               <label>Adresa isporuke</label>
                  <input id="adresaInput"
                         type="text"
                         placeholder="Unesite adresu..."
                  />

                <div className="payment-method">
                  <p>Način plaćanja</p>
                    <label className="radio-option">
                        <input type="radio" name="payment" />
                        Plaćanje karticom
                    </label>

                    <label className="radio-option">
                        <input type="radio" name="payment" />
                        Plaćanje pouzećem
                    </label>
                </div>

                <div className="modal-total">
                    Ukupno: <strong>{ukupno} RSD</strong>
                </div>

                <button className="confirm-btn" onClick={handleConfirmOrder}>
                    Potvrdi porudžbinu
                </button>
              </>
            )}
          </div>
        </div>
      )}
    </>
  );
};

export default FloatingCart;
