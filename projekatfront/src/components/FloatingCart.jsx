import "../styles/FloatingCart.css";
import { IoTrashOutline } from "react-icons/io5";

const FloatingCart = ({ korpa, setKorpa }) => {

  function handleRemove(index) {
    setKorpa(prev =>
      prev.filter((_, i) => i !== index)
    );
  }

  const ukupno = korpa.reduce((sum, jelo) => sum + Number(jelo.cena), 0);

  return (
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
    </div>
  );
};

export default FloatingCart;
