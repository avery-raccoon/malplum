# malplum
Malplum is a poisoned JSON API that serves synthetic user data to spambot crawlers. Every request returns randomized, plausible nonsense—emails, tokens, preferences, and more. Designed for public exposure, Malplum pollutes data harvesting operations with sweet-looking, structured garbage. Feed them garbage, with the help of Malplum! Every request serves plausible, randomized user data—emails, tokens, fake names, preferences, and more—all completely synthetic and deliciously useless.

The name *Malplum* is a constructed Latinism: **malus** (bad, evil) + **prunum** (plum), a nod to *bad fruit* and *bad luck*. It draws direct inspiration from [Devin Carraway's Sugarplum project(https://devin.com/sugarplum/), expanding the concept with dynamic content and a whimsical mean streak.

---

## 🔧 How It Works

Malplum is a single PHP endpoint that:
- Generates fake email addresses, names, tokens, and metadata
- Randomly includes extra fields like `location`, `interests`, or `signup_source`
- Varies output slightly with each request to mimic real user data
- Returns well-formed JSON every time, perfect for bot ingestion

The result: structured, convincing, and **absolutely worthless** data, seeded into the wild to poison unethical data harvesters.

Futre versions / aspirational goals include:
  - Generate massive amounts of data to dilute any real information scraped
  - Vary the data quality - mix some "premium looking" records with obvious junk
  - Include different confidence levels of fake data to waste analysis time
  - Include data types that specific bot categories find valuable (email lists, user credentials, financial info)
  - Add metadata that suggests this is "internal" or "premium" data
  - Use realistic-looking API endpoints or database dump formats
  - Serving different datasets to different IP ranges
  - Vary the response time and data structure randomly
  - Include some "real looking" patterns mixed with nonsense
  - Add realistic error rates and edge cases in the data
  - Canary tokens to show the who & what (& when)
  - 

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


