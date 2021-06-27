pipeline {
     agent any
     stages {
          stage("Get Current Tag") {
               steps {
                    script{
                         //Getting latest tag on git - https://stackoverflow.com/a/7261049 & https://stackoverflow.com/a/62947582/13954598
                         env.GIT_LATEST_TAG = sh (returnStdout:  true, script: "git tag --sort=-creatordate | awk '/^v/' | head -n 1 ").trim()
                    }
                    
                    //Checkout based on tag - https://stackoverflow.com/a/62611390/13954598
                    // checkout( [$class: 'GitSCM', branches: [[name: env.GIT_LATEST_TAG ]],
                    //     doGenerateSubmoduleConfigurations: false, 
                    //     extensions: [[$class: 'CloneOption', 
                    //     depth: 0, 
                    //     noTags: false ]] ] )

               }
          }
          
          stage('Get New Tag') {
               steps {
                    script{
                       def currentTag = env.GIT_LATEST_TAG
                       def tagChunks = currentTag.tokenize(".")
                       def oldMinorVersion = tagChunks[1] as int
                       def newMinowVersion = oldMinorVersion + 1

                       env.FINAL_TAG_VERSION = tagChunks[0] + "." + newMinowVersion + "." + tagChunks[2]
                    }
                    
                    echo env.FINAL_TAG_VERSION
                    //Using env variables with sh - https://stackoverflow.com/a/48026479/13954598                     
                    sh 'echo $FINAL_TAG_VERSION'
               }
          
              
          }

          stage('Creating and Pushing New Tag'){
              steps{
               sh 'git tag $FINAL_TAG_VERSION'
               sh 'git push https://$GITHUB_USER:$GITHUB_PASS@github.com/danpaldev/thank-after-post-plugin.git $FINAL_TAG_VERSION'
              }
          }

     }
}
