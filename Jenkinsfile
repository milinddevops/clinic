#!groovy

import groovy.json.JsonSlurper
import java.net.URL

pipeline {

	agent none
	
	options {
	   timeout(time: 1, unit: 'DAYS')
	}
	stages {
		stage('Init') {
			agent any
			steps {
				echo "Init..."
				init()
			}
		}

		stage('Build Image...') {
		        agent any
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
	sleep 10000
}

// ================================================================================================
// Build steps
// ================================================================================================

def buildAndRegisterImage() {
	def buildResult
	docker.withRegistry(env.REGISTRY_URL) {
		echo "Builing image.....${env.IMAGE_NAME}"
		buildResult = docker.build(env.IMAGE_NAME)
		echo "Pushhing image...."
		//buildResult.push()
	}
}
