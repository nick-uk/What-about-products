# What about the product design?
Snippets and thoughts about old and modern Web apps approaches 

People who work with software they know how feels to watch +5 years old source code of their work, trying to hide the past believing is embarrassing and has no value :)

I don't believe I am a "full-stack" developer with the definition of today but I built in past full products from scratch using pure **minimalistic PHP/CSS and JQuery** without using any ready framework with (surprisingly) very fast and good results with a great number of working features, hosted on bare metal or cloud servers.  

---
I'm fun of modern **Angular/ReactJS** applications with **REST** and **GraphQL** APIs but sometimes it's good to compare the results between an old and a new approach to build a **reference point**. 
---

This repository includes just some code snippets and screenshots of one of my "one-man" projects I built for the Telecom industry and using in production once upon a time. 

## Main features description:
- A scalable backend infrastructure based on Asterisk private branch exchange (PBX).
- Encryption and compression of the traffic IAX/SIP (usually up to 3k concurrent streams ).
- Very friendly draggable dialogs jQuery UI (<1.5MB total JS+PHP).
- Live statistics and VoIP route status for the active calls, call duration link quality.
- Billing calculation and automate receipts by email with custom email body.
- Online payments with Paypal integration.
- Pre-paid VoIP cards generator.
- Basic UI for backend system load monitoring. 
- Automate or manual account creation from registrations or admin panel with CSV import/export support.
- Additional statistics reports with filters.

The best description is the screenshots. All the options you can see were well tested and working functionalities.

## Conclusions  
Years ago we had to work with PHP and separate Web servers without asynchronous backend PHP processing. Now we can build insane fast Go REST/GraphQL apps in a single super portable binary using ridiculous hardware resources to process the same number of requests and be able to scale it up in **<5 secs**. 
