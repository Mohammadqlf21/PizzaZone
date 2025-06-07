  const crustSurcharges = {
  "Original": 0,
  "Garlic_Crust": 1.00,
  "Epic_Crust": 1.50,
  "NewYork_Crust": 2.00
};
    const pizzaData = {
  "BBQ Chicken Pizza": { prices: { small: 10.49, medium: 14.49, large: 17.99 } },
  "Margherita Pizza": { prices: { small: 7.99, medium: 10.99, large: 13.99 } },
  "Mix Cheese Pizza": { prices: { small: 9.49, medium: 12.99, large: 15.99 } },
  "Vegetable Pizza": { prices: { small: 8.49, medium: 11.99, large: 14.99 } },
  "Alfredo Pizza": { prices: { small: 10.99, medium: 15.99, large: 18.99 } },
  "Pepperoni Pizza": { prices: { small: 9.99, medium: 13.99, large: 16.99 } }
};

    
    const validPromoCodes = {
      "BIG20": { discount: 20, description: "20% off your order" },
      "FREEDEL": { discount: "free", description: "Free delivery" },
      "WELCOME10": { discount: 10, description: "10% off for new customers" }
    };
    
    let appliedPromo = null;
    
    function applyPromo() {
      const promoCode = document.getElementById('promoCode').value.trim().toUpperCase();
      const messageEl = document.getElementById('promoMessage');
      
      if (validPromoCodes[promoCode]) {
        appliedPromo = validPromoCodes[promoCode];
        messageEl.textContent = ` Promo applied: ${appliedPromo.description}`;
        showToast(`Promo code applied: ${appliedPromo.description}`);
      } else {
        messageEl.textContent = " Invalid promo code";
        appliedPromo = null;
      }
    }
    
    function openModal(name, description , prices) {
      document.getElementById('pizzaTitle').textContent = `Order ${name}`;
      document.getElementById('pizzaDescription').textContent = description;
      document.getElementById('orderModal').style.display = 'flex';
      document.body.style.overflow = 'hidden'; 

      const sizeDropdown = document.getElementById('size');
      sizeDropdown.innerHTML = '';
      
      for (const size in prices) {
        const price = prices[size];
        const label = size.charAt(0).toUpperCase() + size.slice(1); // Capitalize
        const inches = size === 'small' ? '10"' : size === 'medium' ? '12"' : '14"';
        const option = document.createElement('option');
        option.value = size;
        option.textContent = `${label} - $${price.toFixed(2)} (${inches})`;
        sizeDropdown.appendChild(option);
  }

      setTimeout(() => {
        const paymentSection = document.querySelector('.radio-group');
        if (paymentSection) {
          paymentSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 300);
    }
    
    function closeModal() {
      document.getElementById('orderModal').style.display = 'none';
      document.body.style.overflow = 'auto'; // Re-enable scrolling
    }
    
    function toggleVisa(show) {
      document.getElementById('visaInfo').style.display = show ? 'block' : 'none';
    }
    
    function showToast(message) {
      const toast = document.getElementById('toast');
      toast.textContent = message;
      toast.style.display = 'block';
      
      setTimeout(() => {
        toast.style.display = 'none';
      }, 3000);
    }
    
    function confirmOrder() {
      const size = document.getElementById('size').value;
      const crust = document.getElementById('crust').value;
      const address = document.getElementById('address').value.trim();
      const payment = document.querySelector('input[name="payment"]:checked');
      const instructions = document.getElementById('instructions').value.trim();
      const promoCode = document.getElementById('promoCode').value.trim();

  if (!address) {
    showToast('Please enter your delivery address');
    return;
  }

  if (!payment) {
    showToast('Please select a payment method');
    return;
  }

  if (payment.value === 'visa') {
    const card = document.getElementById('cardNumber').value.trim();
    const expiry = document.getElementById('expiry').value.trim();
    const cvv = document.getElementById('cvv').value.trim();

    if (!card || !expiry || !cvv) {
      showToast('Please complete your card information');
      return;
    }

    if (!/^\d{16}$/.test(card.replace(/\s/g, ''))) {
      showToast('Please enter a valid 16-digit card number');
      return;
    }
  }

  
  

  const pizzaName = document.getElementById('pizzaTitle').textContent.replace('Order ', '');
  const basePrice = pizzaData[pizzaName].prices[size];
  const crustSurcharge = crustSurcharges[crust] || 0;
  const totalPrice = basePrice + crustSurcharge;


  const orderData = {
    pizza_name: pizzaName,
    size: size,
    crust: crust,
    price: totalPrice,
    address: address,
    payment_method: payment.value,
    instructions: instructions,
    promo_code: promoCode
  };
  

  fetch('../php/saveorder.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams(orderData)
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'success') {
      showToast('Order placed successfully!');
      closeModal();

      // Reset form inputs
      document.getElementById('address').value = '';
      document.getElementById('instructions').value = '';
      document.getElementById('cardNumber').value = '';
      document.getElementById('expiry').value = '';
      document.getElementById('cvv').value = '';
      document.getElementById('cash').checked = true;
      toggleVisa(false);

      // Show invoice alert
      let invoiceMessage = `🍕 Order Confirmed!\n\n`;
      invoiceMessage += `Pizza: ${pizzaName}\n`;
      invoiceMessage += `Size: ${document.getElementById('size').options[document.getElementById('size').selectedIndex].text}\n`;
      invoiceMessage += `Crust: ${document.getElementById('crust').options[document.getElementById('crust').selectedIndex].text}\n`;
      invoiceMessage += `Address: ${address}\n`;
      invoiceMessage += `Total: $${totalPrice.toFixed(2)}\n`;
      invoiceMessage += `Payment: ${payment.value === 'cash' ? 'Cash on Delivery' : 'Credit/Debit Card'}\n`;

      if (instructions) {
        invoiceMessage += `Special Instructions: ${instructions}\n`;
      }

      if (appliedPromo) {
        invoiceMessage += `\nPromo Applied: ${appliedPromo.description}\n`;
        if (appliedPromo.discount === 'free') {
          invoiceMessage += `You got FREE DELIVERY!`;
        } else {
          invoiceMessage += `You saved ${appliedPromo.discount}% on your order!`;
        }
      } else if (promoCode) {
        invoiceMessage += `\nNote: Promo code "${promoCode}" was not applied (invalid or expired)`;
      }

      invoiceMessage += `\n\nThank you for your order! Your pizza will arrive in 30-45 minutes.`;

      alert(invoiceMessage);
    } else {
      showToast('Failed to place order. Please try again.');
    }
  })
  .catch(() => {
    showToast('Error submitting order. Please check your connection.');
  });
}
    window.onclick = function(event) {
      const modal = document.getElementById('orderModal');
      if (event.target === modal) {
        closeModal();
      }
    }

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });


