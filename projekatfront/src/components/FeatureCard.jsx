import React, { useState } from 'react'
import CourierModal from "../components/CourierModal";

const FeatureCard = ({Icon,title, items, type}) => {

  const [open, setOpen] = useState(false)

  return (
    <>
      <div className="featureCard">
        <h3>{Icon ? <Icon /> : null}{title}</h3>
        <ul>
          {items.map((item, index) => (
            <li key={index}>{item}</li>
          ))}
        </ul>
        {type === "dostavljac" && (
          <button className="courier-btn" onClick={() => setOpen(true)}>
            Prijavi se i postani dostavljač!
          </button>
        )}
      </div>

      {open && <CourierModal onClose={() => setOpen(false)} />}
    </>
  )
}

export default FeatureCard