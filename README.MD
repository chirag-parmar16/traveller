# 🌍 Traveller Website

A dynamic **PHP-based travel booking platform** where users can explore tours, book their trips, simulate payments, and download receipts upon successful booking.

---

## ✈️ Key Features

- **Tour Booking System**  
  Users can browse travel packages and complete bookings online.

- **Payment Simulation**  
  A fully functional demo payment flow that mimics real-world transactions (for testing purposes).

- **PDF Receipt Generation**  
  After a successful booking and simulated payment, a downloadable **PDF receipt** is generated with all booking details.

- **Responsive Design**  
  Mobile-friendly interface built using HTML, CSS, and JavaScript.

- **Booking History**  
  Optional functionality for users to view or re-download past receipts (if implemented with session or user login).

---

## 🔧 Technologies Used

- **Backend**: PHP  
- **Frontend**: HTML, CSS, JavaScript  
- **Database**: MySQL  
- **PDF Generator**: FPDF or Dompdf (for receipt download)

---

## 🔒 Security Highlights

- Basic input validation and sanitization for booking forms.
- Server-side session handling for secure payment and booking flow.
- PDF receipts are generated only after verified (simulated) payments.

---

## 📄 Receipt Includes

Each PDF receipt contains:

- Booking ID / Reference Number  
- User Details (Name, Email)  
- Tour Name and Details  
- Date of Booking and Travel  
- Total Amount Paid  
- Payment Status  
- Timestamp

---

## 🚀 How to Run Locally

1. **Start Apache and MySQL** via XAMPP, WAMP, or any LAMP stack.
2. **Clone or download** the project into your server directory (e.g., `htdocs`).
3. **Import the MySQL database** using the provided `.sql` file.
4. **Configure `api.php`** with your MySQL credentials.


---

## 📬 Contact

**Developer**: Chirag Parmar  
**Email**: [parmarchirag161005@gmail.com](mailto:parmarchirag161005@gmail.com)

---

## 🪪 License

This project is open-source and available under the **MIT License**.
