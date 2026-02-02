import React from 'react'
import {FaRegStar} from 'react-icons/fa';

const RecenzijaCard = ({recenzija}) => {
  return  (
    <div className="recenzija-card">
      <div className="recenzija-header">
        <span className="recenzija-ocena">
          <FaRegStar /> {recenzija.ocena}
        </span>
      </div>

      <p className="recenzija-komentar">
        {recenzija.komentar}
      </p>
    </div>
  )
}

export default RecenzijaCard