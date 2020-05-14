pipeline {
    agent any
    parameters {
      credentials credentialType: 'com.cloudbees.jenkins.plugins.sshcredentials.impl.BasicSSHUserPrivateKey', defaultValue: 'sshDO', description: 'connect o the server for delivring the package', name: 'sshDO', required: false
    }
    stages {
        stage('Stage 1') {
            steps {
                echo "hello"
            }
        }
    }
}