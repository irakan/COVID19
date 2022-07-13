FROM node:16-alpine

# Set up the working directory
WORKDIR /var/www/html/frontend

# Copy package.json and package-lock.json before other files
# Utilise Docker cache to save re-installing dependencies if unchanged
COPY ../frontend/package*.json ./

# Install dependencies
RUN npm install

# Copy all files
COPY ../frontend/ .

# Build app
RUN npm run build

ENV HOST 0.0.0.0

EXPOSE 3000

CMD ["npm", "run", "start"]

