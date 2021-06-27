pipeline {
     agent any
     stages {
          stage("Get Tag") {
               steps {
                    script{
                         //Getting latest tag on git - https://stackoverflow.com/a/7261049 & https://stackoverflow.com/a/62947582/13954598
                           //Note that we got the second element because jenkins creates a tag for each job.
                         env.GIT_LATEST_TAG = sh (returnStdout:  true, script: "git tag --sort=-creatordate | head -n 2 | sed -n '2 p' ").trim()
                    }
                    
                    //Checkout based on tag - https://stackoverflow.com/a/62611390/13954598
                    // checkout( [$class: 'GitSCM', branches: [[name: env.GIT_LATEST_TAG ]],
                    //     doGenerateSubmoduleConfigurations: false, 
                    //     extensions: [[$class: 'CloneOption', 
                    //     depth: 0, 
                    //     noTags: false ]] ] )

               }
          }
          stage('get_commit_msg') {
               steps {
                    echo env.GIT_LATEST_TAG
               }
          }
     }
}
