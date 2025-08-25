STEP BT STEP USER GUIIDE:

NOTE: The project is connected to the database using MySQL, backend(Laravel), fontend(Nextjs), DevOps (Docker)

Step 1 download Docker Engine:
Link download: https://www.docker.com/products/docker-desktop

Step 2 create  backend project:
# Open terminal

# Move to backend directory
cd backend

# Create new Laravel project
docker run --rm `
  -v "${PWD}:/app" `
  -w /app `
  composer create-project --prefer-dist laravel/laravel .

# Grant permissions to storage directory
sudo chmod -R 777 storage bootstrap/cache

Step 3 create fontend project:
# Open terminal

# Move to fontend directory
cd fontend

# Create new Nextjs project
npx create-next-app@latest . --typescript --eslint --tailwind --app --src-dir --import-alias "@/*" --use-npm --yes . 

Step 4 start docker composer:
# make sure you have 2 files .env.local in frontend file and .env.example in backend file

# start docker composer
open powershell
cd "path to your project"
docker-compose up -d --build

Step 5 create Controller 
echo "# PAOB" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin git@github.com:MITOM06/PAOB.git
git push -u origin main






