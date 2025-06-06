# 🧃 Malplum Bait Links

These are designed to be seeded in public places where bots crawl.

---

### 🍯 API "examples" to embed in docs or pastebins:

```json
curl https://dale-solo-nails-package.trycloudflare.com/api/userinfo.php?email=test@example.com

### 🍯 Poisoned form link:

<form action="https://dale-solo-nails-package.trycloudflare.com/login.php" method="POST" style="display:none">
  <input type="email" name="email" value="admin@example.com">
  <input type="submit" value="Login">
</form>

