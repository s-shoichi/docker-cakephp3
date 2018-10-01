# Docker for CakePHP3

Clone this repository.

初期設定
------------
```bash
cp docker/.env.sample docker/.env
```
Windowsの人はwinnfsdプラグインをインストール
```bash
vagrant plugin install vagrant-winnfsd
```
docker-composeプラグインをインストール
```bash
vagrant plugin install vagrant-docker-compose
```

cakephpのソースコードを配置
--------------------------------------
(初期状態のcakephpは配置済み)
* /path/to/docker/html/app 配下にcakephpのソースコードをコピー

cakephpとmysqlを接続
----------------------------
* /path/to/config/app.phpを/path/to/docker/html/app/config/にコピー
もしくは(cakephpのソースコードを配置した場合)vagrant up 後に、
* html/app/config/app.php のDBのhostを
```bash
cd share/docker && docker-compose exec db bash
cat /etc/hosts の一番下のIPアドレス
```
に変更(vagrant up後の変更後は、docker-compose buildで再構築)

vagrant起動
--------------
```bash
vagrant up
```

docker内に移動
--------------
```bash
vagrant ssh
cd ~/share/docker
```

### then open
http://docker.cakephp:8080

### Yeah! めっちゃホリデイ
