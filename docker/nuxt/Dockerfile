FROM node:16-alpine

# Set up the working directory
WORKDIR /var/www/html/frontend

COPY ../frontend/package*.json ./
RUN npm install

# Specify the host variable
ENV HOST 0.0.0.0

# Expose the Nuxt port
EXPOSE 3000

# Run the Nuxt service
CMD ["npm", "run", "dev"]