#!groovy

import groovy.json.JsonSlurper
import java.net.URL


pipeline {
  agent any 
  options {
    timeout(time: 1, unit: 'DAYS')
  }

  stages() {
    stage("Initilaize") {
      steps {
        init()
      }
    }

    stage("BuildApp") {
      steps {
        buildImageWithContainer()
      }
    }
  }
}



// ================================================================================================
// Initialization steps
// ================================================================================================

def init() {
	env.REGISTRY_URL = "https://cloud.docker.com/repository/docker/milinddocker/clinic"
	env.DOCKER_CREDS = "DockerCredentials"
	env.IMAGE_NAME 	 = "clinic"
}

def buildImageWithContainer() {
   container('docker-cmds') {
     sh 'docker login -u milinddocker -p milind123'
     docker.withRegistry(env.REGISTRY_URL) {
       def buildResult = docker.build(env.IMAGE_NAME)
       sh 'docker login -u milinddocker -p milind123'
       buildResult.push()
     }
   }
}

// ================================================================================================
// Build steps
// ================================================================================================


def buildImage() {
  def build_command = ""
  docker.withDockerContainer("dind"){
    build_command = sh(returnStdout: true, script: "docker build -t clinic -f Dockerfile")
  }
}

def buildAndRegisterImage() {
	def buildResult
	docker.withRegistry(env.REGISTRY_URL) {
	  echo "Builing image.....${env.IMAGE_NAME}"
	  dir('clinic') {
               buildResult = docker.build(env.IMAGE_NAME)
	       //sh 'docker build -t ' + ${env.IMAGE_NAME} + ' -f Dockerfile'
               echo "Pushhing image...."
	       //buildResult.push()
	  }
	}
}

def test() {
  docker.withDockerContainer('docker:dind') {
    def output = docker.build(env.IMAGE_NAME)
  }
}
