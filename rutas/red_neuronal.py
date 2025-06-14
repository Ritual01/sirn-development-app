from flask import Blueprint, request, jsonify
from modelos.red import RedNeuronal

red_neuronal_bp = Blueprint('red_neuronal', __name__)
modelo = RedNeuronal()

@red_neuronal_bp.route('/red-neuronal', methods=['POST'])
def crear_modelo():
    datos = request.json
    modelo.entrenar(datos['entradas'], datos['salidas'])
    return jsonify({"mensaje": "Modelo entrenado exitosamente"}), 201

@red_neuronal_bp.route('/red-neuronal', methods=['GET'])
def obtener_modelo():
    return jsonify({"modelo": modelo.obtener_parametros()}), 200

@red_neuronal_bp.route('/red-neuronal', methods=['DELETE'])
def eliminar_modelo():
    modelo.eliminar()
    return jsonify({"mensaje": "Modelo eliminado exitosamente"}), 204