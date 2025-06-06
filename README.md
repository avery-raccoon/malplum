# malplum
Malplum is a poisoned JSON API that serves synthetic user data to spambot crawlers. Every request returns randomized, plausible nonsense—emails, tokens, preferences, and more. Designed for public exposure, Malplum pollutes data harvesting operations with sweet-looking, structured garbage. Feed them garbage, with the help of Malplum!
- Khan Noonien Singh, probably

**Malplum** is a poisoned JSON API designed to pollute the data streams of spambots and web scrapers. Every request serves plausible, randomized user data—emails, tokens, fake names, preferences, and more—all completely synthetic and deliciously useless.

The name *Malplum* is a constructed Latinism: **malus** (bad, evil) + **prunum** (plum), a nod to *bad fruit* and *bad luck*. It draws direct inspiration from [Devin Carraway's Sugarplum project](https://github.com/dcaraway/sugarplum), expanding the concept with dynamic content and a whimsical mean streak.

---

## 🔧 How It Works

Malplum is a single PHP endpoint that:
- Generates fake email addresses, names, tokens, and metadata
- Randomly includes extra fields like `location`, `interests`, or `signup_source`
- Varies output slightly with each request to mimic real user data
- Returns well-formed JSON every time, perfect for bot ingestion

The result: structured, convincing, and **absolutely worthless** data, seeded into the wild to poison unethical data harvesters.

---

## 🚀 Setup

### 1. Requirements
- PHP 7.4+ with web server (Apache, Nginx, etc.)
- Optional: [Cloudflare Tunnel](https://developers.cloudflare.com/cloudflare-one/connections/connect-apps/) or Tor for public exposure

### 2. Installation
Clone or copy `index.php` into a publicly accessible directory:

```bash
git clone https://github.com/YOURUSERNAME/malplum.git
sudo cp malplum/index.php /var/www/html/index.php


# MIT License

Copyright (c) 2025 avery m.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the “Software”), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell  
copies of the Software, and to permit persons to whom the Software is  
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all  
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR  
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,  
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE  
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER  
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,  
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE  
SOFTWARE.
