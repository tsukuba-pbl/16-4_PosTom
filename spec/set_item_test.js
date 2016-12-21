describe("set_item> ", function(){
	describe("select_person_cnt> ", function(){
		beforeEach(function(){
			spyOn(console, "log");
		    var data = {};
				var voteinfo = {"voter_name": "テスト", "voter_id": "test", "voter_type": "1"};
				var str_voteinfo = JSON.stringify(voteinfo);
				localStorage.clear();
		})

		//候補者が3人未満の場合のテストコード。
		it("under_3", function(){
			$('#checkvote').val("1");
			var selected_json = {
				contender3:"333",
				contender5:"555"
			};
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count < 3");
		});

		//候補者が4人の場合のテストコード。
		it("greater_3", function(){
			$('#checkvote').val("1");
			var selected_json = {
				contender3:"333",
				contender4:"444",
				contender5:"555",
				contender1:"111"
			};
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count > 3");
		});
	});
});
