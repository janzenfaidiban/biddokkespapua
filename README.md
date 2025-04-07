# biddokkespapua


```
git@github.com:janzenfaidiban/biddokkespapua.git
```
✅ Cara Buat SSH Key Lebih dari 1 di cPanel

Gunakan Nama Berbeda Saat Generate Key

```
ssh-keygen -t ed25519 -C "github-biddokkespapua" -f ~/.ssh/id_ed25519_github
```

Tambahkan Public Key ke GitHub

```
cat ~/.ssh/id_ed25519_github.pub
```