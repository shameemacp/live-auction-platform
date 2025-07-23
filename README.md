# Live Auction Platform - Architecture Overview

##  Project Overview

This Laravel application allows users to:

-  Participate in live auctions
-  See real-time countdown and auto time extension
-  Chat with other bidders
-  Use authentication and roles
-  Admins can manage auction products

---

##  Technologies Used

| Component       | Technology                   | Reason                                  |
|----------------|------------------------------|-----------------------------------------|
| Backend        | Laravel 9                   | Elegant PHP framework, MVC support      |
| Auth           | Laravel Breeze               | Simple and customizable auth scaffolding|
| Real-time      | Laravel Echo + WebSockets    | Push updates without refresh            |
| Frontend       | Blade + Bootstrap + JS       | Clean and fast without SPA complexity   |
| DB             | MySQL                        | Relational and well-integrated with Laravel |

---

##  User Roles

###  Admin
- Can create/edit/delete products (auction items)
- Route: `/products`

###  Bidder (Authenticated User)
- Can view all auctions `/auctions`
- Can join auction room `/auction/{product}`
- Can place bids
- Can send/receive chat messages

###  Live Bidding

- Bids must be higher than current price
- If bid is placed in last 10 sec → auction extends by 15 sec
- All users see updated price immediately

---

### 🔸 Live Chat

- Bidders can send messages
- Chat updates instantly using WebSockets

##  Real-Time Functionality

| Event                  | Trigger                         | Action                                 |
|------------------------|----------------------------------|----------------------------------------|
| `NewBidPlaced`         | User places bid                 | Updates current price on all screens   |
| `AuctionTimeExtended`  | Bid in last 10 seconds          | Extends auction by 15 seconds          |
| `NewMessage`           | Chat message sent               | Broadcasts chat message to all users   |

Broadcasts use:

```php
PrivateChannel('product.{product_id}')


##  Security

- Role-based access via middleware
- Private broadcasting channels
- All routes use CSRF token
- Bids validated on backend

##  Future Improvements

- Live video stream for auctions
- Bid notifications
- Admin analytics dashboard
