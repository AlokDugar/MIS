// API Base URL - Change this to your Laravel API endpoint
const API_BASE_URL = "/api"

// Navigation Component
function loadNavigation() {
  const nav = document.getElementById("navigation")
  if (!nav) return

  // Fetch navigation items from API
  fetch(`${API_BASE_URL}/navigation`)
    .then((response) => response.json())
    .then((menuItems) => {
      const currentPage = window.location.pathname.split("/").pop() || "index.html"

      nav.innerHTML = `
                <div class="nav-container">
                    <a href="index.html" class="nav-logo">
                        <div class="nav-logo-icon">M</div>
                        <span class="nav-logo-text">MIS Alumni</span>
                    </a>
                    
                    <ul class="nav-menu" id="navMenu">
                        ${menuItems
                          .map(
                            (item) => `
                            <li>
                                <a href="${item.href}" class="${currentPage === item.href ? "active" : ""}">
                                    ${item.label}
                                </a>
                            </li>
                        `,
                          )
                          .join("")}
                        <li class="nav-cta">
                            <button class="btn btn-primary">Join Network</button>
                        </li>
                    </ul>
                    
                    <button class="nav-toggle" id="navToggle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12h18M3 6h18M3 18h18"></path>
                        </svg>
                    </button>
                </div>
            `

      // Mobile menu toggle
      const navToggle = document.getElementById("navToggle")
      const navMenu = document.getElementById("navMenu")

      navToggle.addEventListener("click", () => {
        navMenu.classList.toggle("active")
      })
    })
    .catch((error) => {
      console.error("Error loading navigation:", error)
      // Fallback navigation
      nav.innerHTML = `
                <div class="nav-container">
                    <a href="index.html" class="nav-logo">
                        <div class="nav-logo-icon">M</div>
                        <span class="nav-logo-text">MIS Alumni</span>
                    </a>
                    <ul class="nav-menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="committees.html">Committees</a></li>
                        <li><a href="clubs.html">Clubs</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            `
    })
}

// Footer Component
function loadFooter() {
  const footer = document.getElementById("footer")
  if (!footer) return

  footer.innerHTML = `
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="index.html" class="footer-logo">
                        <div class="footer-logo-icon">M</div>
                        <span class="footer-logo-text">MIS Alumni</span>
                    </a>
                    <p class="footer-description">
                        Connecting Modern Indian School graduates worldwide to celebrate our shared heritage and build lasting relationships.
                    </p>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"></path>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="committees.html">Committees</a></li>
                        <li><a href="clubs.html">Clubs</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul class="footer-links">
                        <li><a href="#">Reunions</a></li>
                        <li><a href="#">Photo Gallery</a></li>
                        <li><a href="#">News & Updates</a></li>
                        <li><a href="#">Alumni Directory</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li><a href="mailto:info@misalumni.org">info@misalumni.org</a></li>
                        <li style="color: var(--muted-foreground); font-size: 0.875rem;">
                            123 University Avenue<br>
                            Suite 456<br>
                            City, State 12345
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">© ${new Date().getFullYear()} MIS Alumni. All rights reserved.</p>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    `
}

// Load Committees
function loadCommittees() {
  const container = document.getElementById("committees-container")
  if (!container) return

  fetch(`${API_BASE_URL}/committees`)
    .then((response) => response.json())
    .then((committees) => {
      container.innerHTML = committees
        .map(
          (committee) => `
                <div class="committee-card">
                    <h3 class="committee-title">${committee.name}</h3>
                    <p class="committee-description">${committee.description}</p>
                    
                    <div class="committee-info">
                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Leadership</div>
                                <div class="info-text">President: ${committee.president}</div>
                                <div class="info-text">Vice President: ${committee.vicePresident}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-text">${committee.members} members • Est. ${committee.established}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div class="info-content">
                                <a href="mailto:${committee.email}" class="info-link">${committee.email}</a>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Join Committee</button>
                </div>
            `,
        )
        .join("")
    })
    .catch((error) => {
      console.error("Error loading committees:", error)
      container.innerHTML = '<div class="loading">Error loading committees. Please try again later.</div>'
    })
}

// Load Clubs
function loadClubs() {
  const container = document.getElementById("clubs-container")
  const filterContainer = document.getElementById("category-filter")
  if (!container) return

  fetch(`${API_BASE_URL}/clubs`)
    .then((response) => response.json())
    .then((clubs) => {
      // Get unique categories
      const categories = ["All", ...new Set(clubs.map((club) => club.category))]

      // Render category filters
      if (filterContainer) {
        filterContainer.innerHTML = categories
          .map(
            (category) => `
                    <button class="filter-btn ${category === "All" ? "active" : ""}" data-category="${category}">
                        ${category}
                    </button>
                `,
          )
          .join("")

        // Add filter functionality
        const filterButtons = filterContainer.querySelectorAll(".filter-btn")
        filterButtons.forEach((button) => {
          button.addEventListener("click", () => {
            const category = button.dataset.category

            // Update active state
            filterButtons.forEach((btn) => btn.classList.remove("active"))
            button.classList.add("active")

            // Filter clubs
            renderClubs(category === "All" ? clubs : clubs.filter((club) => club.category === category))
          })
        })
      }

      // Initial render
      renderClubs(clubs)
    })
    .catch((error) => {
      console.error("Error loading clubs:", error)
      container.innerHTML = '<div class="loading">Error loading clubs. Please try again later.</div>'
    })
}

function renderClubs(clubs) {
  const container = document.getElementById("clubs-container")

  container.innerHTML = clubs
    .map(
      (club) => `
        <div class="club-card">
            <div class="club-header">
                <h3 class="club-title">${club.name}</h3>
                <span class="club-badge">${club.category}</span>
            </div>
            <p class="club-description">${club.description}</p>
            
            <div class="club-info">
                <div class="info-item">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Leadership</div>
                        <div class="info-text">${club.president} (President)</div>
                        <div class="info-text">${club.vicePresident} (VP)</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-text">${club.meetingSchedule}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div class="info-content">
                        <a href="mailto:${club.email}" class="info-link">${club.email}</a>
                    </div>
                </div>

                <div class="info-text" style="margin-top: 0.5rem;">${club.members} members</div>
            </div>

            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Join Club</button>
        </div>
    `,
    )
    .join("")
}

// Contact Form Handler
function initContactForm() {
  const form = document.getElementById("contactForm")
  if (!form) return

  form.addEventListener("submit", (e) => {
    e.preventDefault()

    const formData = {
      name: form.name.value,
      email: form.email.value,
      subject: form.subject.value,
      message: form.message.value,
    }

    // Send to your Laravel API
    fetch(`${API_BASE_URL}/contact`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then((response) => response.json())
      .then((data) => {
        alert("Message sent successfully!")
        form.reset()
      })
      .catch((error) => {
        console.error("Error sending message:", error)
        alert("Error sending message. Please try again later.")
      })
  })
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", () => {
  loadNavigation()
  loadFooter()
  loadCommittees()
  loadClubs()
  initContactForm()
})
