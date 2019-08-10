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

   stage('delete files from workspace') {
    steps {
      sh 'ls -l'
      sh 'sudo rm -rf ./*'
     }
    }


    stage("BuildApp") {
      steps {
        buildImg()
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


def buildImg() {
  dir("clinic") {
    withDockerContainer("docker:dind") {
      sh 'docker info'
    }
  }
}

def buildImage() {
  def build_command = ""
  docker.withDockerContainer("dind"){
    build_command = sh(returnStdout: true, script: "docker build -t clinic -f Dockerfile")
  }
}

/*def buildAndRegisterImage() {
	def buildResult
	docker.withRegistry(env.REGISTRY_URL) {
	  echo "Builing image.....${env.IMAGE_NAME}"
	  dir('clinic') {
	     withDockerContainer('dind') {
               buildResult = docker.build(env.IMAGE_NAME)
	       //sh 'docker build -t ' + ${env.IMAGE_NAME} + ' -f Dockerfile'
               echo "Pushhing image...."
	       //buildResult.push()
	     }
	  }
	}
}*/

def test() {
  docker.withDockerContainer('docker:dind') {
    def output = docker.build(env.IMAGE_NAME)
  }
}
