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

    stage {
     steps {
       checkout scm
     }
    }

    stage("Build Application") {
      steps {
      	container("dind") {
	     script {
	       echo "Building Image...."
	       buildAndRegisterImage()
	     }
      	}
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
	withDockerContainer("dind") {
	   sh "echo came here"
	}
	/*def buildResult
	docker.withRegistry(env.REGISTRY_URL) {
		echo "Builing image.....${env.IMAGE_NAME}"
		buildResult = docker.build(env.IMAGE_NAME)
		echo "Pushhing image...."
		//buildResult.push()
	}*/
}
