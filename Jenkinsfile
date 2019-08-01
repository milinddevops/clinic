#!groovy

pipeline {

	agent none

	stages {
		stage('Init') {
			agent any
			steps {
				echo "Init..."
				init()
			}
		}

		stage('Build Image...') {
			steps {
				buildAndRegisterImage()
			}
		}
	}
}

// ================================================================================================
// Initialization steps
// ================================================================================================

def init() {
	env.REGISTRY_URL = " https://index.docker.io/v1/milinddocker/clinic"
	env.DOCKER_CREDS = "DockerCredentials"
	env.IMAGE_NAME 	 = "clinic"
}

// ================================================================================================
// Build steps
// ================================================================================================

def buildAndRegisterImage() {
	def buildResult
	docker.withRegistry(env.REGISTRY_URL, env.DOCKER_CREDS) {
		echo "Builing image....."
		buildResult = docker.build(env.IMAGE_NAME)
		echo "Pushhing image...."
		buildResult.push()
	}
}