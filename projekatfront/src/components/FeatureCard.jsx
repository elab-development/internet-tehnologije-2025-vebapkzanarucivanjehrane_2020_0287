import React from 'react'

const FeatureCard = ({Icon,title, items}) => {
  return (
    <div className="card">
      <h3>{Icon}{title}</h3>
      <ul>
        {items.map((item, index) => (
          <li key={index}>{item}</li>
        ))}
      </ul>
    </div>
  )
}

export default FeatureCard
