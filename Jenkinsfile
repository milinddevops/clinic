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
				buildImage()
			}
		}
	}
}

// ================================================================================================
// Initialization steps
// ================================================================================================

def init() {
	env.REGISTRY_URL = "https://cloud.docker.com/repository/docker/milinddocker/clinic"
}

def buildImage() {
	def buildResult
	docker.withRegistry(env.REGISTRY_URL) {
		echo "Connecting to image registry....."

	}
}

def loginToImageRegistry() {

}

