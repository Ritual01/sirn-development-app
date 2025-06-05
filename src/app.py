from flask import Flask
from rutas.red_neuronal import red_neuronal_bp

app = Flask(__name__)

app.register_blueprint(red_neuronal_bp, url_prefix='/api/red-neuronal')

if __name__ == '__main__':
    app.run(debug=True)